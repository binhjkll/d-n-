
                                                
                                            <?php foreach ($shophtml as $value) { ?>
                                                
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="index.php?act=shophtml&category_id=<?php echo $value->category_id; ?>">
                                                            <i class="fas fa-apple-alt me-2"></i><?php echo $value->name; ?>
                                                        </a>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                           