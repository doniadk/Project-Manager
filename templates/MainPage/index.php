<head>
    <style>
        textarea {
            width: 95%;
            min-width: 200px;
            padding: 8px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
            resize: none;
            background-color: #f9f9f9;
            transition: background-color 0.2s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }

        thead {
            background-color: #f0f0f0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            vertical-align: top;
        }

        .multi-line-item {
            margin-bottom: 5px;
        }

        #button_excel, #button_pdf {
            font-size: 13px;
            height: 50px;
            flex: 1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #button_excel {
            background-color: darkgreen;
        }
        #button_excel:hover {
            background-color: green;
        }

        #button_pdf {
            background-color: darkred;
        }
        #button_pdf:hover {
            background-color: red;
        }

        .button-container {
            width: 500px;
            margin: 0 auto;
            justify-content: center;
            display: flex;
            gap: 30px;
            padding: 30px;
        }

        button i {
            margin-right: 8px;
            font-size: 20px;
            vertical-align: middle;
        }

        .search-container {
            display: flex;
            gap: 25px;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-container input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-container button {
            background-color: #D33C43;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-container button:hover {
            background-color: #a7282d;
        }

        .status-terminee {
            color: green;
            font-weight: bold;
        }

        .status-en-cours {
            color: red;
            font-weight: bold;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<!-- Search Form -->
<div style="background: white; padding: 20px; box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.2); height: 120px; margin-bottom: 50px;">
    <form method="get" action="/" class="search-container">
        <div style="flex: 5;">
            <label for="date">Select date:</label>
            <input type="date" id="date" name="date" value="<?= h($date) ?>">
        </div>
        <button type="submit" style="flex: 1; margin-top: 20px; text-align:center; padding: 5px; width: 25px; height: 50px;">
            <i class="fa fa-search" style="font-size: 20px;"></i> 
            <span style="font-size: 12px; vertical-align: middle;">Search</span>
        </button>
    </form>
</div>

<?php if (!empty($projects)): ?>
    <?= $this->Form->create(null, ['url' => '/']) ?>
        <input type="hidden" name="date" value="<?= h($date) ?>">

        <div style="background: white; padding: 20px; box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.2);">
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 20px;">Project</th>
                        <th>Personnels</th>
                        <th>Tâches</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $index => $project): ?>
                    <tr>
                        <td style="padding-left: 20px;"><?= h($project->projet->nom) ?></td>
                        <td>
                            <?php
                            if (!empty($project->personnels)) {
                                foreach ($project->personnels as $p) {
                                    echo '<div class="multi-line-item">' . h($p->nom) . '</div>';
                                }
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($project->taches)) {
                                foreach ($project->taches as $t) {
                                    if ($t->progres === 'terminee') {
                                        $statusClass = 'status-terminee';
                                        $statusText = '✅ Terminé';
                                    } else {
                                        $statusClass = 'status-en-cours';
                                        $statusText = '⏳ En cours';
                                    }

                                    echo '<div class="multi-line-item">'
                                        . h($t->titre) 
                                        . ' <span class="' . $statusClass . '">' . $statusText . '</span>'
                                        . '</div>';
                                }
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>

                        <td>
                            <textarea name="notes[<?= $index ?>]" placeholder="écrire des remarques ici"></textarea>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="button-container">
            <button type="submit" name="export" value="excel" id="button_excel">
                <i class="fa-regular fa-file-excel"></i> Download Excel
            </button>
            <button type="submit" name="export" value="pdf" id="button_pdf">
                <i class="fa-regular fa-file-pdf"></i> Download PDF
            </button>
        </div>
    <?= $this->Form->end() ?>
<?php else: ?>
    <p>No selected date.</p>
<?php endif; ?>
