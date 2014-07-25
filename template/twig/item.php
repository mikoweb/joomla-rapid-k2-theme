<?php
/**
 * @package		K2
 * @author		Rafał Mikołajun <rafal@mikoweb.pl>
 * @subpackage  Bootstrap HTML5 template
 */

// no direct access
defined('_JEXEC') or die;
?>
<article class="blogArticle">
    <?php echo $this->item->event->BeforeDisplay; ?>
    <?php echo $this->item->event->K2BeforeDisplay; ?>

    <header>
        <?php if($this->item->params->get('catItemDateCreated')): ?>
        <time datetime="<?php echo JHTML::_('date', $this->item->created , 'Y-m-d H:i'); ?>"><?php echo JHTML::_('date', $this->item->created , 'd F Y'); ?></time>
        <?php endif; ?>
        <?php if($this->item->params->get('catItemTitle')): ?>
        <h2 class="itemTitle"><?php echo $this->item->title; ?></h2>
        <?php endif; ?>
    </header>

    <?php echo $this->item->event->AfterDisplayTitle; ?>
    <?php echo $this->item->event->K2AfterDisplayTitle; ?>

    <?php echo $this->item->event->BeforeDisplayContent; ?>
    <?php echo $this->item->event->K2BeforeDisplayContent; ?>

    <?php if(!empty($this->item->fulltext)): ?>
        <?php if($this->item->params->get('itemIntroText')): ?>
            <!-- Item introtext -->
            <div class="itemIntroText">
                <?php echo $this->item->introtext; ?>
            </div>
        <?php endif; ?>
        <?php if($this->item->params->get('itemFullText')): ?>
            <!-- Item fulltext -->
            <div class="itemFullText">
                <?php echo $this->item->fulltext; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <!-- Item text -->
        <div class="itemFullText">
            <?php echo $this->item->introtext; ?>
        </div>
    <?php endif; ?>

    <?php echo $this->item->event->AfterDisplayContent; ?>
    <?php echo $this->item->event->K2AfterDisplayContent; ?>

    <?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
        <section class="tags">
            <ul>
                <?php foreach ($this->item->tags as $tag): ?>
                    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php if($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)): ?>
        <aside class="authorInfo">
            <?php if($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)): ?>
                <div class="avatar">
                    <img src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
                </div>
            <?php endif; ?>
            <div class="authorDetails">
                <h3 class="authorName"><?php echo $this->item->author->name; ?></h3>

                <?php if($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)): ?>
                    <?php echo $this->item->author->profile->description; ?>
                <?php endif; ?>

                <?php if ($this->item->params->get('itemAuthorURL') || $this->item->params->get('itemAuthorEmail')) : ?>
                <ul class="authorLinks">
                    <?php if($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)): ?>
                        <li class="website"><a href="<?php echo $this->item->author->profile->url; ?>" target="_blank"><?php echo str_replace('http://','',$this->item->author->profile->url); ?></a></li>
                    <?php endif; ?>
                    <?php if($this->item->params->get('itemAuthorEmail')): ?>
                        <li class="email"><?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>

                <?php echo $this->item->event->K2UserDisplay; ?>

            </div>
        </aside>
    <?php endif; ?>

    <?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0): ?>
        <span class="itemDateModified">
		    <?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
		</span>
    <?php endif; ?>

    <?php echo $this->item->event->AfterDisplay; ?>
    <?php echo $this->item->event->K2AfterDisplay; ?>

    <?php echo $this->item->event->K2CommentsBlock; ?>

</article>