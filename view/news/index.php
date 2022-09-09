<div class="main">
    <h1>Новости</h1>
    <hr>
    <div class="notes">

        <?php
        foreach ($notes as $note):?>
            <div class="notes-item">
                <span class="date"><?= $note['idate']; ?></span>
                <a href="view.php?id=<?= $note['id'] ?>"><?= $note['title'] ?></a>
                <p class="preview"><?= $note['announce'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <h2>Страницы:</h2>
    <div class="pagination">
        <ul>
            <?php for ($i = 1; $i <= $pageCount; $i++):
                if ($i != $nav):?>
                    <a class="page" href="?page=<?= $i ?>">
                        <li class="disabled"><?= $i ?></li>
                    </a>
                <?php
                else:?>
                    <a class="page" href="?page=<?= $i ?>">
                        <li class="active"><?= $i ?></li>
                    </a>
                <?php endif; endfor;
            ?>
        </ul>
    </div>
</div>
