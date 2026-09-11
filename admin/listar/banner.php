<?php
if (!isset($pagina)) exit;
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Listagem de Banner</h2>
        </div>
        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">Novo Registro</a>
            <a href="listar/banner" class="btn btn-info">Listar</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Imagem</td>
                    <td>Descrição</td>
                    <td>Ativo</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from banner order by id";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                $dadosBanners = $consulta->fetchAll(PDO::FETCH_OBJ);

                foreach ($dadosBanners as $dados) {
                ?>
                    <tr>
                        <td><img src="../arquivos/<?= $dados->banner ?>" alt="<?= $dados->descricao ?>" width="120px"></td>
                        <td><?= $dados->descricao ?></td>
                        <td><?= $dados->ativo == "S" ? "Sim" : "Não" ?></td>
                        <td>
                            <a href="cadastrar/banner/<?= $dados->id ?>" class="btn btn-success btn-sm">Editar</a>
                            <a href="javascript:excluir(<?= $dados->id ?>)" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function excluir(id) {
        Swal.fire({
            title: "Você tem certeza de que deseja excluir este registro?",
            showCancelButton: true,
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) location.href="excluir/banner/"+id;
        });
    }
</script>