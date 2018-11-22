<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 13:35
 */
?>

<span id="battleship">Battleship</span>

<div class="example-wrapper">
    <div id="battle-field">
        <?php foreach ($grid as $key => $row): ?>
            <?php foreach ($row as $k => $value): ?>
                <div id="<?php echo "{$key}_{$k}"; ?>" class="cell <?php if ($value) { echo "s ship"; } else { echo "w empty"; } ?>"></div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>

<button id="play" class="button-secondary pure-button" data-hidden="false">Play</button>
<span id="desc" data-hidden="true">Press any key to fire.</span>

<script>
    grid = <?php echo json_encode($grid);?>
</script>
<script type="text/javascript" src="/js/main.js"></script>

