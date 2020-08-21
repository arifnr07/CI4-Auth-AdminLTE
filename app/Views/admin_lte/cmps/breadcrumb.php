<?php
$request = service('request');

?>

<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
    <?php
    $uri = service('uri');
    $segments = $uri->getSegments();
    $totalSegment = $uri->getTotalSegments();
    $is_active = $request->uri->getSegment($totalSegment);
    $count = 0;
    $url = '';
    foreach ($segments as $segment) : ?>
        <?php if (is_numeric($segment) == '1') : ?>

        <?php else : ?>
            <li class="breadcrumb-item <?php echo $segment ? '' : '' ?>">
                <?php
                $count++;

                if ($segment == $is_active || $segment == 'edit') : ?>
                    <?php echo ucfirst($segment) ?>
                <?php else :
                    $url .= '/';
                    $url .= $request->uri->getSegment($count);
                ?>
                    <a href="<?php echo base_url($url) ?>"><?php echo ucfirst($segment) ?></a>
                <?php endif; ?>
            </li>
        <?php endif; ?>



    <?php endforeach; ?>

</ol>