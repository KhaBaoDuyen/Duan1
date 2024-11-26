<?php

namespace App\Views\Client\Pages\Reminder;

use App\Views\BaseView;
use App\Views\Client\Components\Menu as ComponentsMenu;
class index extends BaseView
{
   public static function render($data = null)
   {
      ?>
      <style>
         .no-border {
            border: none;
            outline: none;
         }
      </style>
      <main class="p-2 profile d-flex justify-content-center align-items-center ">
         <section class="sec_profile d-flex col-10">
            <?php
            ComponentsMenu::render();
            ?>
            <article class="sec_profile_right col-9 d-flex " style="background:white !important;">
               <div class="my_profile col-12 ">
                  <h4>Lịch nhắc nhở tưới cây</h4>
                  <table class="table table-hover" style="background: none !important;">
                     <thead class="text-center table-success" >
                        <tr>
                           <th>Id</th>
                           <th style="width:20%;">Tiêu đề</th>
                           <th>Lời nhắc</th>
                           <th style="width:11%;">Trạng thái </th>
                           <th>Thời gian</th>

                           <th colspan="2" style="width:5%;">Lưu</th>
                           <th style="width:5%;">Xóa</th>
                        </tr>
                     </thead>
                     <tbody class="text-center">
                        <?php
                        if (isset($data) && !empty($data)):
                           $counter = 1;
                           foreach ($data as $reminder):
                              ?>
                              <tr class="">
                                 <td><?= $counter++ ?></td>
                                 <form action="/reminder/<?= $reminder['id'] ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="method" value="PUT">
                                    <td><input type="text" name="title" value="<?= $reminder['title'] ?>"
                                          class="form-control no-border text-center"></td>


                                    <td>
                                       <textarea name="description" style="height: 15px;"
                                          class="form-control no-border text-center"><?= $reminder['description'] ?></textarea>
                                    </td>
                                    <td>
                                       <div class="form-group checkStatus">
                                          <div class="radio-input d-flex">
                                             <label>
                                                <input type="radio" name="status" value="1" id="status-on" <?= $reminder['status'] == 1 ? 'checked' : '' ?> />
                                                <span>Bật</span>
                                             </label>
                                             <label>
                                                <input type="radio" name="status" value="0" id="status-off"
                                                   <?= $reminder['status'] == 0 ? 'checked' : '' ?> />
                                                <span>Tắt</span>
                                             </label>
                                          </div>
                                       </div>

                                    </td>
                                    <td><input type="time" name="reminder_date" value="<?= $reminder['reminder_date'] ?>"
                                          class="form-control no-border text-center"></td>
                                    <td colspan="2">
                                       <button type="submit" class="btn btn-sm btn-success"><span
                                             class="text-light material-symbols-outlined">
                                             save_clock
                                          </span></button>
                                    </td>
                                 </form>
                                 <td>
                                    <form action="/reminder/<?= $reminder['id'] ?>" method="post" style="display: inline-block;"
                                       onsubmit="return confirm('Bạn có chắc chắn xóa danh mục <?= $reminder['title'] ?>?')">
                                       <input type="hidden" name="method" value="DELETE">
                                       <button type="submit" class="btn btn-sm btn-danger"><span class="material-symbols-outlined">
                                             delete
                                          </span></button>
                                    </form>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        <?php endif ?>
                     </tbody>

                  </table>

               </div>
            </article>
         </section>

      </main>

   <?php }
} ?>