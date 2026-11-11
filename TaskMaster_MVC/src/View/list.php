<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Master - MVC</title>
    <style>
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-top: 20px; margin-bottom: 25px; }
        .form-group label { font-weight: 600; font-size: 14px; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 8px; }
        button { background: #2563eb; color: white; border: none; padding: 12px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #1d4ed8; }
        
        .task-list { list-style: none; padding: 0; margin: 0; }
        .task-item { display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 15px; margin-bottom: 12px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; }
        .task-info { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex: 1; min-width: 0; }
        .task-field { display: flex; flex-direction: column; gap: 5px; min-width: 0; }
        .task-field strong { font-size: 12px; color: #6b7280; }
        .task-field span { font-size: 14px; overflow-wrap: anywhere; }
        .actions { display: flex; gap: 10px; flex-shrink: 0; }
        .actions a { text-decoration: none; font-size: 18px; }
        .done span, .done small { text-decoration: line-through; color: #9ca3af; }
        
        @media (max-width: 600px) {
            .task-item { align-items: flex-start; flex-direction: column; }
            .task-info { flex-wrap: wrap; width: 100%; }
            .task-field { flex: 1 1 40%; }
            .actions { align-self: flex-end; }
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

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li class="<?php echo $task['done'] ? 'done' : ''; ?>">
                <div>
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