<div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Imported Saving Types</th>
                                         
                
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($employeeInfo) && !empty($employeeInfo)) {
                foreach ($employeeInfo as $key => $element) {
                    ?>
                    <tr>
                        <td><?php echo $element['saving_type_name']; ?></td>   
                         
                        
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">There is no saving type.</td>    
                </tr>
            <?php } ?>
        </tbody>

    </table>
    <?php echo anchor("saving_type/saving_type", "Back", array("class"=>"btn btn-primary btn-sm")); ?><br></br>

</div>