
<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>
        <div class="row">
<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?php if ($options['labelWrapper'] !== false): ?>
        <div class="<?= $options['labelWrapper']['class'] ?>" >
    <?php endif; ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
    <?php if ($options['labelWrapper'] !== false): ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php if ($options['fieldWrapper'] !== false): ?>
        <div class="<?= $options['fieldWrapper']['class'] ?>" >
    <?php endif; ?>
        <?= Form::input($type, $name, $options['value'], $options['attr']) ?>
    <?php if ($options['fieldWrapper'] !== false): ?>
        </div>
    <?php endif; ?>
    <?php include helpBlockPath(); ?>
<?php endif; ?>

<?php include errorBlockPath(); ?>

        </div>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
