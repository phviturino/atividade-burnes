<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {

        $sql = "select * from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosBanner->id ?? NULL;
    $descricao = $dadosBanner->descricao ?? NULL; 
    $banner = $dadosBanner->banner ?? NULL;        
    $ativo = $dadosBanner->ativo ?? "S";         
?>
<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Banner
        </div>
        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>
            <a href="listar/banner" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastrar" method="post" action="salvar/banner"
        data-parsley-validate enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="form-control" readonly
                    value="<?= $id ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="descricao">Descrição:</label>
                    <input type="text" name="descricao" id="descricao"
                    class="form-control" required
                    data-parsley-required-message="Preencha este campo"
                    value="<?= $descricao ?>">
                </div>
                <div class="col-12 col-md-2">
                    <label for="ativo">Ativo:</label>
                    <select name="ativo" id="ativo" class="form-control">
                        <option value="S" <?= $ativo == "S" ? "selected" : "" ?>>Sim</option>
                        <option value="N" <?= $ativo == "N" ? "selected" : "" ?>>Não</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <label for="imagem">Imagem do Banner:</label>
                    <input type="file" name="imagem" id="imagem"
                    class="form-control" accept=".jpg,.jpeg,.png"
                    <?= empty($id) ? "required" : "" ?>>
                </div>
                <?php if (!empty($banner)) { ?>
                <div class="col-12">
                    <label>Imagem atual:</label><br>
                    <img src="../arquivos/<?= $banner ?>" width="250px" class="mt-1 shadow">
                </div>
                <?php } ?>
            </div>
            <br>
            <button type="submit" class="btn btn-success float-end">
                Salvar Registro
            </button>
        </form>
    </div>
</div>