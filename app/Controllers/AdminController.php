<?php
require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/StatsSqlModel.php';
require_once __DIR__ . '/../Models/StatsModel.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

class AdminController
{
  public function dashboard(): void
  {
    Auth::requireRole(['Admin']);
    require_once __DIR__ . '/../Views/pages/admin-dashboard.php';
  }

  public function employees(): void
  {
    Auth::requireRole(['Admin']);

    $userModel = new UserModel();
    $employees = $userModel->getAllEmployees();

    require_once __DIR__ . '/../Views/pages/admin-employees.php';
  }

  public function createEmployee(): void
  {
    Auth::requireRole(['Admin']);

    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $nom = trim($_POST['nom'] ?? '');
      $prenom = trim($_POST['prenom'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';
      $confirmPassword = $_POST['confirm_password'] ?? '';

      $utilisateur = new Utilisateur(
        $nom,
        $prenom,
        $email,
        true,
        'Employé'
      );

      if (
        !$utilisateur->informationsValides()
        || $password === ''
        || $confirmPassword === ''
      ) {
        $error = "Tous les champs sont obligatoires.";
      } elseif (!$utilisateur->longueursValides()) {
        $error = "Un ou plusieurs champs sont trop longs.";
      } elseif (!$utilisateur->emailValide()) {
        $error = "Adresse email invalide.";
      } elseif ($password !== $confirmPassword) {

        $error = "Les mots de passe ne correspondent pas.";
      } else {

        if (!Utilisateur::motDePasseValide($password)) {
          $error = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        } else {

          $userModel = new UserModel();

          if ($userModel->emailExists($email)) {

            $error = "Cette adresse email existe déjà.";
          } else {

            $passwordHash = password_hash(
              $password,
              PASSWORD_DEFAULT
            );

            $employeeCreated = $userModel->createEmployee(
              $nom,
              $prenom,
              $email,
              $passwordHash
            );

            if ($employeeCreated) {

              $mailService = new MailService();

              $mailService->sendEmployeeAccountCreatedEmail(
                $email,
                $prenom,
                $nom
              );

              header(
                'Location: index.php?url=admin-employes'
              );
              exit;
            }

            $error = "Erreur lors de la création du compte employé.";
          }
        }
      }
    }

    require_once __DIR__ . '/../Views/pages/admin-create-employee.php';
  }

  public function statistics(): void
  {
    Auth::requireRole(['Admin']);

    $statsSqlModel = new StatsSqlModel();
    $statsMongoModel = new StatsModel();

    // 1. Calcul depuis MySQL
    $statisticsFromSql = $statsSqlModel->getStatisticsByMenu();

    // 2. Synchronisation vers MongoDB
    $statsMongoModel->synchronizeFromSql($statisticsFromSql);

    // 3. Lecture depuis MongoDB
    $statistics = $statsMongoModel->getAll();

    // 4. Total des commandes pour les pourcentages
    $totalCommandes = array_sum(
      array_column($statistics, 'commandes')
    );

    require_once __DIR__ . '/../Views/pages/admin-statistics.php';
  }


  public function turnover(): void
  {
    Auth::requireRole(['Admin']);

    $statsSqlModel = new StatsSqlModel();
    $statsMongoModel = new StatsModel();

    // Synchronisation MySQL vers MongoDB
    $completedOrders = $statsSqlModel->getCompletedOrdersForStatistics();

    $statsMongoModel->synchronizeTurnoverFromSql(
      $completedOrders
    );

    // Récupération des filtres GET
    $menuId = (int) ($_GET['menu_id'] ?? 0);
    $dateDebut = trim($_GET['date_debut'] ?? '');
    $dateFin = trim($_GET['date_fin'] ?? '');

    // Petite validation des dates
    $filterError = null;

    if (
      $dateDebut !== '' &&
      $dateFin !== '' &&
      $dateDebut > $dateFin
    ) {
      $filterError = "La date de début doit être antérieure à la date de fin.";
      $statistics = [];
    } else {
      // Lecture filtrée depuis MongoDB
      $statistics = $statsMongoModel->getTurnoverStatistics(
        $menuId > 0 ? $menuId : null,
        $dateDebut !== '' ? $dateDebut : null,
        $dateFin !== '' ? $dateFin : null
      );
    }

    require_once __DIR__ . '/../Views/pages/admin-turnover.php';
  }

  public function editEmployee(): void
  {
    Auth::requireRole(['Admin']);

    $error = null;
    $employeeId = (int) ($_GET['id'] ?? 0);

    $userModel = new UserModel();

    $employee = $userModel->getEmployeeById($employeeId);

    if (!$employee) {
      http_response_code(404);
      echo "Employé introuvable.";
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $nom = trim($_POST['nom'] ?? '');
      $prenom = trim($_POST['prenom'] ?? '');
      $email = trim($_POST['email'] ?? '');

      $utilisateur = new Utilisateur(
        $nom,
        $prenom,
        $email,
        (bool) $employee['actif'],
        'Employé'
      );

      if (!$utilisateur->informationsValides()) {
        $error = "Tous les champs sont obligatoires.";
      } elseif (!$utilisateur->longueursValides()) {
        $error = "Un ou plusieurs champs sont trop longs.";
      } elseif (!$utilisateur->emailValide()) {
        $error = "Adresse email invalide.";
      } else {

        $existingUser = $userModel->findByEmail($email);

        if (
          $existingUser
          && (int) $existingUser['id'] !== $employeeId
        ) {
          $error = "Cette adresse email existe déjà.";
        } else {

          $updated = $userModel->updateEmployee(
            $employeeId,
            $nom,
            $prenom,
            $email
          );

          if ($updated) {
            header(
              'Location: index.php?url=admin-employes'
            );
            exit;
          }

          $error = "Erreur lors de la modification de l'employé.";
        }
      }
    }

    require_once __DIR__ . '/../Views/pages/admin-edit-employee.php';
  }

  public function toggleEmployeeStatus(): void
  {
    Auth::requireRole(['Admin']);

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      return;
    }

    $employeeId = (int) ($_GET['id'] ?? 0);

    $userModel = new UserModel();
    $employee = $userModel->getEmployeeById($employeeId);

    if (!$employee) {
      http_response_code(404);
      echo "Employé introuvable.";
      return;
    }
    $utilisateur = new Utilisateur(
      $employee['nom'],
      $employee['prenom'],
      $employee['email'],
      (bool) $employee['actif'],
      $employee['role']
    );

    $newStatus = !$utilisateur->estActif();

    $updated = $userModel->updateEmployeeStatus(
      $employeeId,
      $newStatus
    );

    if (!$updated) {
      http_response_code(500);
      echo "Impossible de modifier le statut de l'employé.";
      return;
    }

    header('Location: index.php?url=admin-employes');
    exit;
  }
}
