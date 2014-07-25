<?php
/**
 * @package		K2
 * @author		Rafał Mikołajun <rafal@mikoweb.pl>
 * @subpackage  Bootstrap HTML5 template
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
?>
<article class="clearfix">
    <?php if($this->item->params->get('catItemImage') && !empty($this->item->image)): ?>
    <figure>
        <a href="<?php echo $this->item->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
            <img src="<?php echo $this->item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->title); ?>" />
        </a>
        <?php if(!empty($this->item->image_caption)) : ?>
        <figcaption><?php echo $this->item->image_caption; ?></figcaption>
        <?php endif; ?>
    </figure>
    <?php endif; ?>
    <header>
        <?php if($this->item->params->get('catItemDateCreated')): ?>
        <time datetime="<?php echo JHTML::_('date', $this->item->created , 'Y-m-d H:i'); ?>"><?php echo JHTML::_('date', $this->item->created , 'd F Y'); ?></time>
        <?php endif; ?>
        <?php if($this->item->params->get('catItemTitle')): ?>
        <h3 class="itemTitle">
            <?php if ($this->item->params->get('catItemTitleLinked')): ?>
                <a href="<?php echo $this->item->link; ?>">
                    <?php echo $this->item->title; ?>
                </a>
            <?php else: ?>
                <?php echo $this->item->title; ?>
            <?php endif; ?>
        </h3>
        <?php endif; ?>
    </header>
    <?php if($this->item->params->get('catItemIntroText')): ?>
    <p><?php echo $this->item->introtext; ?></p>
    <?php endif; ?>
    <?php if ($this->item->params->get('catItemReadMore')): ?>
    <a class="btn btn-primary" href="<?php echo $this->item->link; ?>"><?php echo JText::_('K2_READ_MORE'); ?></a>
    <?php endif; ?>
</article>