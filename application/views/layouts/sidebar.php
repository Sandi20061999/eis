<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Menu</li>
            <?php foreach ($menu as $m) : ?>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                       <span class="nav-text"><?= $m['menu']; ?></span>
                    </a>
                    <ul aria-expanded="false">
                        <?php foreach ($subMenu as $s) : ?>
                            <?php if ($m['id'] == $s['menu_id']) { ?>
                                <li><a href="<?php echo base_url() . $s['url'] ?>" class="link">
                                        <?= $s['title']; ?>
                                    </a></li>
                            <?php } ?>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid pt-5">