<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Admin Account</span>
                </div>
                <div class="actions">
                 <?php //pr($users_customers); ?>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('users_customers','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:$users_customers->first_name;?>" class="form-control" placeholder="Firstname"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:$users_customers->last_name;?>" class="form-control" placeholder="Lastname"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Comment</label>
			<br>
			<textarea name="comment" style="width: 637px; height: 293px;"><?php echo isset($app['POST']['comment'])?$app['POST']['comment']:$users_customers->comment;?></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" value="<?php echo isset($app['POST']['email'])?$app['POST']['email']:$users_customers->email;?>" class="form-control" placeholder="Email"> 
                                        </div> 
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name='password' value="" class="form-control" placeholder="password"> 
                                            <span class="help-inline">Leave empty if you don't want to update</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Trustworthy</label>
                                                    <input type="checkbox" name="trustworthy" <?php echo ($users_customers->is_trustworthy == 1) ? 'checked' : ''?> value="1" > 
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Active</label>
                                                    <input type="checkbox" name="active" <?php echo ($users_customers->is_active == 1) ? 'checked' : ''?> value="1" > 
                                                </div> 
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Verified</label>
                                                    <input type="checkbox" name="verified" <?php echo ($users_customers->is_verified == 1) ? 'checked' : ''?> value="1" > 
                                                </div>
                                            </div>
                                        </div>
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update User Info</button>
                                    <a class="btn default" href="<?php app_url('users_customers','list','list');?>">Cancel</a>
                                </div>
                            </div>
<div>
                                    <a class="btn btn-info btn-sm" href="mailto: <?php echo  $users_customers->email;?> ?subject=Ausgezeichnet.cc | Account Verifizierung &amp;body=Sehr geehrte/r <?php echo  $users_customers->first_name . ' ' . $users_customers->last_name;?>,%0D%0A%0D%0Avielen Dank f&uuml;r Ihr Interesse an unseren Produkten.%0D%0AUns ist aufgefallen, dass Sie sich registriert, aber noch nicht verzifiziert haben.%0D%0AWahrscheinlich ist das Verifizierungsemail im Spam-Filter h&auml;ngen geblieben? Wir haben Ihren User manuell freigeschalten.%0D%0AFalls Sie das Mail noch im Spam-Ordner finden, bitte markieren Sie es nach M&ouml;glichkeit als &ldquo;kein Spam&rdquo;, dass zuk&uuml;nftige Best&auml;tigungen etc. &ldquo;durchkommen&rdquo;.%0D%0A%0D%0AMit besten Gr&uuml;&szlig;en%0D%0AIhr Team von Ausgezeichnet.cc" title="Mail"><i class="class="fa fa-pencil"></i>Mail: Account manuell Verifiziert (Standard)</a>
</div>

<div>
                                    <a class="btn btn-info btn-sm" href="mailto: <?php echo  $users_customers->email;?> ?subject=Ausgezeichnet.cc | Accountnutzung &amp;body=Sehr geehrte/r <?php echo  $users_customers->first_name . ' ' . $users_customers->last_name;?>,%0D%0A%0D%0ASie haben sich vor einiger Zeit auf Ausgezeichnet.cc registriert. Uns ist aufgefallen, dass Sie Ihren Account nicht nutzen bzw. keine Auszeichnungen eingepflegt haben. %0D%0AK&ouml;nnen wir Ihnen dabei helfen, sich im Onlinesystem zurecht zu finden?
%0D%0AIst unsere Dienstleistung aus anderen Gr&uuml;nden f&uuml;r Sie nicht mehr relevant?%0D%0A%0D%0A
Falls Sie Fragen, W&uuml;nsche oder Anregungen haben, sind wir gerne f&uuml;r Sie erreichbar und freuen uns &uuml;ber Ihr Feedback.%0D%0A
%0D%0A
Mit besten Gr&uuml;&szlig;en%0D%0A
Ihr Team von Ausgezeichnet.cc

" title="Mail"><i class="class="fa fa-pencil"></i>Mail: Erinnerung keine Auszeichnungen</a>
</div>


<div>
                                    <a class="btn btn-info btn-sm" href="mailto: <?php echo  $users_customers->email;?> ?subject=Ausgezeichnet.cc | DSGVO - L&ouml;schung Ihres Accounts&amp;body=Sehr geehrte/r <?php echo  $users_customers->first_name . ' ' . $users_customers->last_name;?>,%0D%0A%0D%0ASie haben sich vor einiger Zeit auf Ausgezeichnet.cc registriert. Leider konnten wir f&uuml;r Ihren Account keine Nutzung seit der Registrierung feststellen. %0D%0AIm Rahmen der DSGVO sehen wir uns leider gezwungen, Ihren Account zu l&ouml;schen.%0D%0A%0D%0A
Falls Sie Fragen, W&uuml;nsche oder Anregungen haben, sind wir gerne f&uuml;r Sie erreichbar und freuen uns &uuml;ber Ihr Feedback.%0D%0A
%0D%0A
%0D%0A
Mit besten Gr&uuml;&szlig;en%0D%0A
Florian Hell

" title="Mail"><i class="class="fa fa-pencil"></i>Mail: Account l&ouml;schen</a>
</div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
