<?php $title ='Edit Configuration' ?>
<?php ob_start() ?>

    <div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
    <div class="card-body p-0">
            <div class="row">
                <div class="col"> 
                <div class="p-5">
                        <div class="text-center text-primary">
                            <div class="icon"><i class="fas fa-sitemap fa-3x mb-2"></i></div>
                            <h3 class="mb-5"><b>Edit Configuration</b></h3>
                        </div>
                        <form action="<?= ROOT ?>configurations/update"  method="POST">
                                                        
                            <input type="hidden" name="id" value="<?= $configuration->id; ?>">

                            <div class="form-group row">

                                <div class="col-12  mb-3">
                                        <label for="type">Configuration Type</label>
                                        <input type="text" readonly class="form-control"  name="type" value="<?= $configuration->type;?>" id="type" placeholder="<?= $configuration->type;?>" >
                                </div>

                                <div class="col-12  mb-3">
                                        <label for="value">Configuration Value</label>
                                        <input type="text" class="form-control"  name="value" value="<?php if(isset($_SESSION['oldData']['value'])) { echo $_SESSION['oldData']['value'] ; unset($_SESSION['oldData']['value']); } else { echo $configuration->value; } ?>" id="value" placeholder="Enter configuration value" >
                                        <?php if(isset($_SESSION['errors']['value_error'])): ?>
                                            <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['value_error'] ?></span>
                                            <?php unset($_SESSION['errors']['value_error']) ?>
                                        <?php endif;?>
                                </div>
                                
                                <div class="col-12 mb-3 d-flex justify-content-end">
                                            
                                    <a class="btn btn-sm btn-danger mr-2" href="<?= ROOT ?>configurations"><i class="fas fa-times-circle"></i> Cancel</a>
                                    <button type="submit" class="btn btn-sm btn-primary" name="saveType" value="edit">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>   

                                </div>
                            
                            </div>

                        </form>
                </div>
                </div>
            </div>
    </div>
    </div>

<?php  $content = ob_get_clean()?>