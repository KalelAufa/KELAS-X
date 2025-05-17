<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar User</h1>
        <a href="?f=user&m=insert" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah User</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data User</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tbluser ORDER BY user ASC";
                        $row = $db->getALL($sql);
                        $no = 1;

                        if (!empty($row)) {
                            foreach ($row as $r) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r['user'] ?></td>
                                    <td><?php echo $r['email'] ?></td>
                                    <td><span class="badge bg-<?php echo ($r['level'] === 'admin') ? 'primary' : (($r['level'] === 'koki') ? 'success' : 'info'); ?>"><?php echo $r['level'] ?></span></td>
                                    <td><a href="?f=user&m=delete&id=<?php echo $r['iduser'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i>Delete</a></td>
                                    <td><a href="?f=user&m=update&id=<?php echo $r['iduser'] ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit me-1"></i>Update</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Tidak ada data user</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>