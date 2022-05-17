<?php foreach($Searchfolder as $Searchfolderrow): ?>
                     <figure class="figure">
                      <a href="<?= base_url('document/file_upload/'.$Searchfolderrow['id'])?>"><i class="fa fa-folder" style="font-size:50px;color:#f6bd60; margin-left: 20px"></i>
                        <figcaption class="figcaption text-center"><?=$Searchfolderrow['folder_name']?>
                        </figcaption>
											</a>
                      </figure>
                      
                    <?php endforeach; ?>
