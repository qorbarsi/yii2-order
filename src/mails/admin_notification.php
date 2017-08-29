<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\DetailView;
?>
<h1><?=Yii::t('order', 'New order'); ?> #<?=$model->id;?></h1>

<!--p><?=Html::a(Yii::t('order', 'View'), Url::to(['/order/order/view', 'id' => $model->id], true));?></p-->

<ul>
    <?php if($model->client_name) { ?>
        <li><?= Yii::t('order', 'Client name'); ?>:&nbsp;<?=$model->client_name;?></li>
    <?php } ?>

    <?php if($model->phone) { ?>
        <li><?= Yii::t('order', 'Phone'); ?>:&nbsp;<?=$model->phone;?></li>
    <?php } ?>

     <?php if($model->email) { ?>
        <li><?= Yii::t('order', 'Email'); ?>:&nbsp;<?=Html::a($model->email, 'mailto:'.$model->email);?></li>
    <?php } ?>

    <?php if($model->comment) { ?>
        <li><?= Yii::t('order', 'Comment'); ?>:&nbsp;<?=$model->comment;?></li>
    <?php } ?>

    <li><?= Yii::t('order', 'Order date'); ?>:&nbsp;<?=$model->date;?> <?=$model->time;?></li>

    <?php if($model->paymentType) { ?>
        <li><?= Yii::t('order', 'Payment type'); ?>:&nbsp;<?=$model->paymentType->name;?></li>
    <?php } ?>
    <b>
        <?php if($model->payment !== 'no') {
            echo Yii::t('order', 'Paid');
        } else {
            echo Yii::t('order', 'Unpaid');
        } ?>
    </b>

    <?php if($model->shipping) { ?>
        <li><?= Yii::t('order', 'Delivery type'); ?>:&nbsp;<?=$model->shipping->name;?></li>
    <?php } ?>

    <?php if($model->delivery_type == 'totime') { ?>
        <?=Yii::t('order', 'Delivery to time'); ?>:&nbsp;<?=$model->delivery_time_date;?> <?=$model->delivery_time_hour;?>:<?=$model->delivery_time_min;?>
    <?php } ?>


    <?php if($model->address) {?>
        <?= Yii::t('order', 'Delivery address'); ?>:&nbsp;<?= $model->address; ?>
    <?php } ?>

    <?php
    if($fields = $model->fields) {
        foreach($fields as $fieldModel) {
            echo "<li>{$fieldModel->field->name}:&nbsp;{$fieldModel->value}</li>";
        }
    }
    ?>
</ul>

<h2><?=Yii::t('order', 'Order list'); ?></h2>

<?php if($model->elements) { ?>
    <table width="100%" style="text-align: left;">
        <thead>
            <tr>
                <th><?=Yii::t('order', 'Product name'); ?></th>
                <th><?=Yii::t('order', 'Amount'); ?></th>
                <th><?=Yii::t('order', 'Item price'); ?></th>
                <th><?=Yii::t('order', 'Total cost'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($model->elements as $element) { ?>
            <tr>
                <td>
                    <?=$element->product->getCartName(); ?>
                    <?php if($element->description) { echo "({$element->description})"; } ?>
                    <?php
                    if($options = json_decode($element->options)) {
                        foreach($options as $name => $value) {
                            $return .= Html::tag('p', Html::encode($name).': '.Html::encode($value));
                        }
                    }
                    ?>
                </td>
                <td>
                    <?=$element->count;?>
                </td>
                <td>
                    <?=$model->getFormatted($element->price);?>
                </td>
                <td>
                    <?=$model->getFormatted($element->price*$element->count);?>
                </td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left"><b><?=Yii::t('order', 'In total'); ?></b></td>
                <td><?= $model->getCount() ?></td>
                <td>&nbsp;</td>
                <td><?= $model->getTotalFormatted() ?></td>
            </tr>
            <tr>
                <td style="text-align: left" colspan="3"><b><?=Yii::t('order', 'With discount'); ?>
                    <?php if($model->promocode) {
                        echo $model->promocode;
                    } ?>
                </td>
                <td><b><?= $model->getCostFormatted() ?></b></td>
            </tr>
        </tbody>
    </table>
<?php } ?>
