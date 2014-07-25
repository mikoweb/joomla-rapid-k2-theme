<?php
/**
 * @package		K2
 * @author		Rafał Mikołajun <rafal@mikoweb.pl>
 * @subpackage  Bootstrap HTML5 template
 */

// no direct access
defined('_JEXEC') or die;

?>
<section class="blogItems">
    <div class="page-header">
        <h2><?php echo $this->params->get('page_title_clean'); ?></h2>
    </div>

    <?php if(count($this->items)): ?>
        <div class="row-fluid">
            <?php foreach($this->items as $key=>$item): ?>
                <?php if ($key%2==0 && $key!=0) echo '</div><div class="row-fluid">'; ?>
                <div class="span6">
                    <article class="clearfix">
                        <?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
                            <figure>
                                <a href="<?php echo $item->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>">
                                    <img src="<?php echo $item->imageGeneric; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
                                </a>
                                <?php if(!empty($item->image_caption)) : ?>
                                    <figcaption><?php echo $item->image_caption; ?></figcaption>
                                <?php endif; ?>
                            </figure>
                        <?php endif; ?>
                        <header>
                            <?php if($item->params->get('tagItemDateCreated',1)): ?>
                                <time datetime="<?php echo JHTML::_('date', $item->created, 'Y-m-d H:i'); ?>"><?php echo JHTML::_('date', $item->created, 'd F Y'); ?></time>
                            <?php endif; ?>
                            <?php if($item->params->get('tagItemTitle',1)): ?>
                                <h3 class="itemTitle">
                                    <?php if ($item->params->get('tagItemTitleLinked',1)): ?>
                                        <a href="<?php echo $item->link; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo $item->title; ?>
                                    <?php endif; ?>
                                </h3>
                            <?php endif; ?>
                        </header>
                        <?php if($item->params->get('tagItemIntroText',1)): ?>
                            <p>
                                <?php
                                $introtext = explode(' ', strip_tags($item->introtext)); $i=1;
                                foreach($introtext as $word)
                                {
                                    echo $word;
                                    if ($i>14)
                                    {
                                        echo '...';
                                        break;
                                    }
                                    else echo ' ';
                                    $i++;
                                } ?></p>
                        <?php endif; ?>
                        <?php if ($item->params->get('tagItemReadMore')): ?>
                            <a class="btn btn-primary" href="<?php echo $item->link; ?>"><?php echo JText::_('K2_READ_MORE'); ?></a>
                        <?php endif; ?>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if($this->pagination->getPagesLinks()): ?>
        <div class="pagination">
            <?php echo $this->pagination->getPagesLinks(); ?>
            <?php //echo $this->pagination->getPagesCounter(); ?>
        </div>
    <?php endif; ?>
</section>
