<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Search extends BaseView
{
   public static function render($data = null)
   {
      ?>


      <div class="container-fluid" id="container-wrapper">
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh mục</h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/admin">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
            </ol>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="card mb-4">
                  <div class="card-header py-3 d-flex align-items-center justify-content-between">

                     <div class=" justify-content-start align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục </h6>
                        <div>
                           <?php
                           if (isset($data['keyword']) && $data['keyword'] !== '') {
                              echo '<div style="width: max-content;" class="d-flex  m-auto">Kết quả tìm kiếm: ' . htmlspecialchars($data['keyword']) . '</div>';
                           } else {
                              echo "Không có từ khóa tìm kiếm nào được nhập.";
                           }
                           ?>
                        </div>
                     </div>

                     <div class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-search fa-fw"></i>
                        </a>
                        <div style="width: 350px !important;"
                           class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                           aria-labelledby="searchDropdown">
                           <form class="navbar-search" action="/admin/SearchUsers" method="get">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-light border-1 small"
                                    placeholder="Nhập từ khóa tìm kiếm ?" aria-label="Search" aria-describedby="basic-addon2"
                                    id="input" class="input" name="keyword" type="keyword" style="border-color: #3f51b5;">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                       <i class="fas fa-search fa-sm"></i>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>

                  </div>

                  <div class="table-responsive p-3">
                     <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                        <thead class="thead-light">
                           <tr>
                              <th>Id</th>
                              <th>Avatar</th>
                              <th>Tên đăng nhập</th>
                              <th>Số điện thoại</th>
                              <th>Email</th>
                              <th>Vai trò</th>
                              <th>Khác</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (isset($data['users']) && !empty($data['users'])): ?>
                              <?php foreach ($data['users'] as $user): ?>
                                 <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td>
                                       <?php if ($user['avatar']): ?>
                                          <img title="<?= $user['name'] ?>" style="border-radius: 50%;" class="img_all" width="50px"
                                             height="50px" src="/public/uploads/users/<?= $user['avatar'] ?>" alt="img">
                                       <?php else: ?>
                                          <img title=" <?= $user['name'] ?>" style="border-radius: 50%;" class="img_all" width="50px"
                                             height="50px" src="/public/uploads/users/usermacdinh.png" alt="img">
                                       <?php endif; ?>
                                    </td>
                                    <td><a title="<?= $user['name'] ?>"
                                          href="/admin/users/<?= $user['id'] ?>"><?= $user['username'] ?></a></td>
                                    <td><?= $user['phone'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td>
                                       <span class="badge p-2 <?= $user['role'] == 1 ? 'badge-success' : 'badge-danger' ?>">
                                          <?= $user['role'] == 1 ? 'Người dùng' : 'Quản trị' ?>
                                       </span>
                                    </td>
                                    <td>
                                       <a href="/admin/users/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                       <form action="/admin/users/<?= $user['id'] ?>" method="post" style="display: inline-block;"
                                          onsubmit="return confirm('Bạn có chắc chắn xóa ngời dùng <?= $user['username'] ?>?')">
                                          <input type="hidden" name="method" value="DELETE">
                                          <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                       </form>
                                    </td>
                                 </tr>
                              <?php endforeach ?>
                           <?php else: ?>
                              <tr>
                                 <td colspan="7">Không có người dùng nào tìm thấy.</td>
                              </tr>
                           <?php endif ?>
                        </tbody>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php
   }
}
?>