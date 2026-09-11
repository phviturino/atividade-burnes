<?php
    if (!isset($pagina)) exit;

    if ($_POST) {

        $id = htmlspecialchars(trim($_POST["id"] ?? NULL));
        $descricao = htmlspecialchars(trim($_POST["descricao"] ?? NULL));
        $ativo = htmlspecialchars(trim($_POST["ativo"] ?? "S"));

        $banner = NULL;

        if (!empty($_FILES["imagem"]["name"])) {
            $banner = time();
            $banner = "{$banner}.jpg";
            if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], "../arquivos/{$banner}")) {
                mensagem("Erro", "Erro ao copiar arquivo para o servidor", "error");
            }
    
        }

        if (empty($descricao)) {
            mensagem("Erro", "Preencha a descrição", "error");
        } else if (empty($id) and empty($banner)) {
            mensagem("Erro", "Selecione uma imagem para o banner", "error");
        } else if (empty($id)) {
            $sql = "insert into banner (id, descricao, banner, ativo)
                values (NULL, :descricao, :banner, :ativo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":ativo", $ativo);
        } else if (empty($banner)) {
            $sql = "update banner set descricao = :descricao, ativo = :ativo
                where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);
        } else {
            $sql = "update banner set descricao = :descricao, ativo = :ativo, banner = :banner
                where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":id", $id);
        }

        if (isset($consulta) and $consulta->execute()) {
            mensagem("Sucesso!", "Registro salvo", "success");
        } else if (isset($consulta)) {
            mensagem("Erro", "Erro ao gravar", "error");
        }

    } else {
        mensagem("Erro", "Requisição inválida", "error");
    }