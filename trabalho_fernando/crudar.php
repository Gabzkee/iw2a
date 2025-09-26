<?php

header('Content-Type: application/json; charset=utf-8');

$host = 'localhost';
$db   = 'atividade_terc_bimest';
$usuario = 'root';     
$senha = '';      
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $usuario, $senha, $options);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Falha na conexão com o banco: ' . $e->getMessage()]);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';

try {
    switch ($action) {
        case 'list': {
            $search = trim($_GET['search'] ?? '');
            if ($search !== '') {
                $stmt = $pdo->prepare("
                    SELECT id, objeto, tipo, levantavel
                    FROM objetos
                    WHERE objeto LIKE :t OR tipo LIKE :t
                    ORDER BY id DESC
                ");
                $term = "%{$search}%";
                $stmt->execute([':t' => $term]);
            } else {
                $stmt = $pdo->query("SELECT id, objeto, tipo, levantavel FROM objetos ORDER BY id DESC");
            }
            echo json_encode($stmt->fetchAll());
            break;
        }

        case 'get': {
            $id = (int)($_GET['id'] ?? 0);
            $stmt = $pdo->prepare("SELECT id, objeto, tipo, levantavel FROM objetos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode($stmt->fetch());
            break;
        }

        case 'create': {
            $objeto  = trim($_POST['objeto']  ?? '');
            $tipo = trim($_POST['tipo'] ?? '');
            $levantavel = (isset($_POST['levantavel']) && $_POST['levantavel'] == '1') ? 1 : 0;

            if ($objeto === '' || $tipo === '') {
                http_response_code(400);
                echo json_encode(['error' => 'objeto e tipo são obrigatórios.']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO objetos (objeto, tipo, levantavel) VALUES (?, ?, ?)");
            $stmt->execute([$objeto, $tipo, $levantavel]);

            echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId()]);
            break;
        }

        case 'update': {
            $id    = (int)($_POST['id'] ?? 0);
            $objeto  = trim($_POST['objeto']  ?? '');
            $tipo = trim($_POST['tipo'] ?? '');
            $levantavel = (isset($_POST['levantavel']) && $_POST['levantavel'] == '1') ? 1 : 0;

            if ($id <= 0 || $objeto === '' || $tipo === '') {
                http_response_code(400);
                echo json_encode(['error' => 'ID, objeto e tipo são obrigatórios.']);
                exit; 
            }

            $stmt = $pdo->prepare("UPDATE objetos SET objeto = ?, tipo = ?, levantavel = ? WHERE id = ?");
            $stmt->execute([$objeto, $tipo, $levantavel, $id]);

            echo json_encode(['ok' => true]);
            break;
        }

        case 'delete': {
            $id = (int)($_POST['id'] ?? 0);
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['error' => 'ID inválido.']);
                exit;
            }
            $stmt = $pdo->prepare("DELETE FROM objetos WHERE id = ?");
            $stmt->execute([$id]);

            echo json_encode(['ok' => true]);
            break;
        }

        default: {
            http_response_code(400);
            echo json_encode(['error' => 'Ação inválida.']);
            break;
        }
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
}
