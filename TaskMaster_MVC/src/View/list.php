<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Master - MVC</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 48px 20px;
            background: #f3f4f6;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }
        .container {
            width: min(100%, 760px);
            margin: 0 auto;
            padding: 32px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
        }
        h1 { margin: 0 0 24px; font-size: clamp(24px, 5vw, 32px); }
        .error {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 6px;
            background: #fee2e2;
            color: #991b1b;
        }
        .form-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 0 0 28px;
        }
        .form-group input {
            width: 100%;
            min-width: 0;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font: inherit;
        }
        .form-group input:focus {
            outline: 2px solid #93c5fd;
            border-color: #2563eb;
        }
        button {
            padding: 12px 16px;
            border: 0;
            border-radius: 6px;
            background: #2563eb;
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        .task-list { display: grid; gap: 12px; list-style: none; padding: 0; margin: 0; }
        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
        }
        .task-info { min-width: 0; overflow-wrap: anywhere; }
        .task-info strong { font-size: 16px; }
        .task-info small { display: inline-block; margin-top: 6px; color: #6b7280; }
        .actions { display: flex; flex-shrink: 0; gap: 12px; }
        .actions a { font-size: 20px; text-decoration: none; }
        .done .task-info { color: #9ca3af; text-decoration: line-through; }

        @media (max-width: 560px) {
            body { padding: 20px 12px; }
            .container { padding: 22px 18px; }
            .form-group { grid-template-columns: 1fr; }
            .task-item { align-items: flex-start; }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Task Master (MVC Edition)</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- O formulário agora aponta para a action 'create' -->
    <form method="POST" action="index.php?action=create" class="form-group">
        <input type="text" name="title" placeholder="Título" required>
        <input type="text" name="description" placeholder="Descrição">
        <input type="date" name="due_date" required>
        <button type="submit">Adicionar</button>
    </form>

    <ul class="task-list">
        <?php foreach ($tasks as $task): ?>
        <li class="task-item <?php echo $task['done'] ? 'done' : ''; ?>">
            <div class="task-info">
                    <strong><?php echo htmlspecialchars($task['title']); ?></strong><br>
                    <small><?php echo htmlspecialchars($task['description']); ?> | Vence em: <?php echo $task['due_date']; ?></small>
                </div>
                <div class="actions">
                    <?php if (!$task['done']): ?>
                        <a href="index.php?action=complete&id=<?php echo $task['id']; ?>">✅</a>
                    <?php endif; ?>
                    <a href="index.php?action=delete&id=<?php echo $task['id']; ?>">❌</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>