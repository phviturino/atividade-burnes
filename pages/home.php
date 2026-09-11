<div class="container p-5">
    <?php
    $sqlBanners = "select * from banner where ativo = 'S' order by id";
    $consultaBanners = $pdo->prepare($sqlBanners);
    $consultaBanners->execute();
    $dadosBanners = $consultaBanners->fetchAll(PDO::FETCH_OBJ);
?>
<div id="carouselBanners" class="carousel slide mb-5 shadow" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $primeiro = true; foreach ($dadosBanners as $dados) { ?>
            <div class="carousel-item <?= $primeiro ? "active" : "" ?>">
                <img src="arquivos/<?= $dados->banner ?>" class="d-block w-100" alt="<?= $dados->descricao ?>">
            </div>
        <?php $primeiro = false; } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

    <h2>Destaques de Hoje:</h2>

    <div class="row">
        <?php
            $sqlDestaques = "select f.id, f.titulo, f.ano, f.original, f.capa, c.categoria
                from filme f
                inner join categoria c on (c.id = f.categoria_id)
                order by rand() limit 4";
            $consulta = $pdo->prepare($sqlDestaques);
            $consulta->execute();

            $dadosDestaques = $consulta->fetchAll(PDO::FETCH_OBJ);

            foreach ($dadosDestaques as $dados) {
                ?>
                <div class="col-12 col-md-3">
                    <div class="card shadow">
                        <img src="arquivos/<?= $dados->capa ?>" alt="<?= $dados->titulo ?>" class="w-100">
                        <div class="card-body">
                            <h3><?= $dados->titulo ?></h3>
                            <p><i><?= $dados->original ?></i> (<?= $dados->ano ?>)</p>
                            <p>Categoria: <?= $dados->categoria ?></p>
                            <p>
                                <a href="filme/<?= $dados->id ?>" title="Detalhes" class="btn btn-warning w-100">
                                    Detalhes
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>

</div>