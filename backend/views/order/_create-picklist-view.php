<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\components\Helpers as Helper;

/* @var $this yii\web\View */

?>
<div class="container">
<div class="row">
	<div class="col-md-6">
  		<div class="" id="createPicklistMessagePopupBox" style="display:none;"></div>    
 	</div>
</div>
<div class="row">
<?php $form = ActiveForm::begin(['action' => 'index.php?r=order/create-picklist&type=export','id'=>'createPicklistForm']); ?>
	<div class="col-md-2">
		<div class="form-group">
			<select name="id_carrier_picklist" id="id_carrier_picklist" class="form-control">
		 		<option value="">Select Carrier</option>
		 		<?php if(!empty($getAllCarrier)) { ?>
		 		<?php foreach($getAllCarrier as $carrierDetail) { ?>
		 			<option value="<?php echo $carrierDetail['id_reference'];?>" <?php if(isset($getParam['id_reference']) && $getParam['id_reference']==$carrierDetail['id_reference']) {echo 'selected';}?>><?php echo $carrierDetail['name'];?>
		 		</option>
		 		<?php } 
		 		}?>
			</select>
		</div>
    </div>
	<?php if (isset($sellers) && count($sellers)>0) { ?>
	<div class="col-md-2">
		<div class="form-group">
			<select class="form-control" name="id_seller_picklist" id="id_seller_picklist">
				<option value="">Select Seller</option>
				<?php
                if (isset($sellers)) {
                    foreach ($sellers as $sellerDetail) {
                        ?>
                        <option value="<?php echo $sellerDetail['id_seller']; ?>" <?php if(isset($getValues['sellerFilter']) && in_array($sellerDetail['id_seller'], $getValues['sellerFilter'])){echo 'selected';} ?>><?php echo $sellerDetail['company']; ?></option>
                       <?php
                            }
                        } else {
                            ?>
                <?php } ?>
			</select>
		</div>
    </div>
	<?php } else { ?>
	<input type="hidden" name="id_seller_picklist" id="id_seller_picklist" value="<?php if(Helper::getSessionId()) { echo Helper::getSessionId(); } ?>"></input>
	<?php } ?>
    <div class="col-md-2">
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="createPicklist()">Generate</button>
		</div>
    </div>
	<?= Html::input('hidden', 'picklistMultipleOrderIds', '', ['id' => 'picklistMultipleOrderIds']) ?>

<?php ActiveForm::end(); ?>
</div>
</div>
