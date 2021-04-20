<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $data <?php echo $this->getModelClass(); ?> */
?>

<section class="panel panel-default">
					
                        
                        
                        

<?php
$columns = array();
foreach($this->tableSchema->columns as $column)
{
	$columns[] = $column;
}




echo "
						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode(\$data->{$columns[2]->name}), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode(\$data->{$columns[3]->name}), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?></small>
                            </div>
                          </div>
                        </header>
";


echo "<div class='list-group no-radius alt'>";


$count=0;
foreach($this->tableSchema->columns as $column)
{
	
	if($column->isPrimaryKey)
		continue;
	if(++$count==7){
		echo "\t<?php /*\n";
	}
	
	echo '
                          <a class="list-group-item">
	';
	echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?></b><br>\n";
	echo "\t<?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t<br />\n\n";
	echo '
                          </a>
	
	';
}
if($count>=7)
	echo "\t*/ ?>\n";
?>

                        </div>
</section>