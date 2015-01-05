<form method="post" action="<?=$_extend_url;?>&pmod=user&op=install">
<table class="table-font"><tbody>
    <?php foreach ($connect['config'] as $key=>$value){ ?>
    	<tr <?php if($value['type']=='hidden'){ ?>style="display:none"<?php } ?>>
            <th class="w120"><?=$value['lan'];?>：</th>
            <td>
            	<input type="<?=$value['type'];?>" 
					   id="<?=$connectkey;?>_<?=$key;?>" 
					   name="connect[<?=$key;?>][value]" 
					   <?php if($value['type']=='checkbox'){ ?>
					   		value="<?=$value['default'];?>"
					   		<?php if($value['default']==$value['value']){ ?>checked<?php } ?>
					   <?php }else{  ?>
					   value="<?=$value['value'];?>"
					   <?php } ?>
					   >
            	<?php if(!empty($value['label'])) ?>
            	<label for="<?=$connectkey;?>_<?=$key;?>"><?=$value['label'];?></label>
            </td>
        </tr>
    <?php } ?>
    </tbody></table>
    <input type="hidden" name="key" value="<?=$connectkey;?>">
    <div class="box-footer">
        <div class="box-footer-inner">
        	<input type="submit" value="保存更改">
        </div>
    </div>
</form>