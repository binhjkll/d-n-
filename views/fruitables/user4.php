    <!-- Navbar start -->
    <?php
    require "inc/header.php";
    ?>
    <!-- Navbar End -->


                    <tbody>
                        <?php foreach ($listbook as $value): ?>
                            <!-- Modal -->
                            <div class="modal fade" id="cancelModal<?php echo $value->order_id; ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="?act=huyorder">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel">Xác nhận huỷ đơn hàng</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có chắc chắn muốn huỷ đơn hàng <strong>#<?php echo $value->order_id; ?></strong> không?</p>
                                                <div class="mb-3">
                                                    <label for="cancelReason<?php echo $value->order_id; ?>" class="form-label">Lý do huỷ:</label>
                                                    <select class="form-select" id="cancelReason<?php echo $value->order_id; ?>" name="cancel_reason" required onchange="toggleOtherReason(<?php echo $value->order_id; ?>)">
                                                        <option value="">-- Chọn lý do --</option>
                                                        <option value="Đặt nhầm">Đặt nhầm</option>
                                                        <option value="Thay đổi ý định">Thay đổi ý định</option>
                                                        <option value="Không cần nữa">Không cần nữa</option>
                                                        <option value="Tôi muốn đổi thông tin, địa chỉ đặt hàng">Tôi muốn đổi thông tin, địa chỉ đặt hàng</option>
                                                        <option value="Lý do khác">Lý do khác</option>
                                                    </select>
                                                </div>
                                                <!-- Textarea for "Lý do khác" -->
                                                <div class="mb-3" id="otherReason<?php echo $value->order_id; ?>" style="display: none;">
                                                    <label for="otherReasonInput<?php echo $value->order_id; ?>" class="form-label">Nhập lý do:</label>
                                                    <textarea class="form-control" id="otherReasonInput<?php echo $value->order_id; ?>" name="other_reason" rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="order_id" value="<?php echo $value->order_id; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-danger" name="btn_submit">Xác nhận huỷ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td class="text-center align-middle"><?php echo $value->order_id; ?></td>
                                <td class="text-center align-middle">$<?php echo number_format($value->total_amount, 2); ?></td>
                                <td class="text-center align-middle"><?php echo $value->payment_status; ?></td>
                                <td class="text-center align-middle"><?php echo $value->delivery_status; ?></td>
                                <td class="text-center align-middle"><?php echo $value->created_at; ?></td>
                                <td class="text-center align-middle"><?php echo $value->name; ?></td>
                                <td class="text-center align-middle"><?php echo $value->address; ?></td>
                                <td class="text-center align-middle">0<?php echo $value->phone; ?></td>
                                <td class="text-center align-middle"><?php echo $value->email; ?></td>
                                <td class="text-center align-middle">
                                    <a href="?act=chitietpro&pid=<?php echo $value->order_id; ?>" class="btn btn-dark btn-sm">Chi tiết</a>
                                </td>
                                <td class="text-center align-middle">
                                    <?php if ($value->delivery_status == 'Đang chuẩn bị') { ?>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $value->order_id; ?>">
                                            Huỷ
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
