<option <?php if ($category['id'] == $this->model->category_id) echo ' selected'; ?>  value="<?=  $category['id'] ?>"><?= $tab . $category['name'] ?></option>

<?php if (isset($category['childs'])) : ?>
    <ul> 
    
        <?= $this->getMenuHtml($category['childs'], $tab. '-') ?>
    </ul>
<?php endif; ?>