


<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> View Orders</span>
                </div>
                <div class="actions"></div>
            </div>
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">

                        <table class="table">
                            <tr>
                                <th>Ribbon ID</th> 
                                <th>Ribbon Name </th> 
                                <th>Total</th> 
                            </tr>
                            
                            <?php
                        $showDebug=false;
                            $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;

                            $ToExclude=array("monika@gmail.com","silenoz@gmx.at","hashmonika@gmail.com","fghdfgh@gmail.com","joek@battrx.com","rrrrr@gmail.com","parasmaluja94@gmail.com","parasmaluja99@gmail.com","a@gmail.com","hfgh@gmail.com","x@gmail.com","l@gmail.com","jlll@battrx.com","joek2@battrx.com","paras1@gmail.com","parasmaluja94@gmail.comdf","joe@battrx.com","jp@battrx.com","joeky@battrx.com","joey@battrx.com","joekyy@battrx.com","joekyyy@battrx.com","jo@battrx.com","jo1@battrx.com","jo2@battrx.com","ffgg@hotmail.com","fg@def.gfh","hashkapilkalra@gmail.com","florian.hell@gmx.at","florian.hell@ausgezeichnet.cc","hashgaurav@gmail.com","office@zblh.at");

                            foreach($orders as $order)
                            {

                                $DoNotAdd=0;

                                    foreach($ToExclude as $emailToExclude)
                                    {
                                        if($order->billing_email==$emailToExclude)
                                        {
                                            $DoNotAdd=1;
                                        }
                                    }
                                
                                if($DoNotAdd==0)
                                {
                                    
                                echo '<tr>';
                                    echo '<td>'.$count++.'</td>';
                                    echo '<td>'.$order->id.'</td>';
                                    echo '<td>'.$order->billing_firstname.'</td>';
                                echo '</tr>';
                                }
                            }
                            ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div align="center">
    <ul class='pagination text-center' id="pagination">
    <?php 
    echo $pagination;
    ?>

    </ul>
</div>
