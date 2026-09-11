<?php
    if (!isset($pagina)) exit;

    if (empty($id)) {
        mensagem("Erro", "Registro inválido", "error");
    } else {
        $sql = "select banner from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);
        $arquivo = "../arquivos/{$dadosBanner->banner}";

        $sql = "delete from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);

        if ($consulta->execute()) {
            if (!empty($dadosBanner->banner) and file_exists($arquivo)) unlink($arquivo);
            mensagem("Sucesso", "Registro excluído", "success");
        } else {
            mensagem("Erro", "Erro ao excluir", "error");
        }
    }