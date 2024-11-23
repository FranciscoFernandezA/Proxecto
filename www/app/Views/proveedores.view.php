<div class="row">       
    <?php
    if(isset($error)){
        ?>
    <div class="col-12">
        <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Proveedores</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($proveedores) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>CIF</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Dirección</th>                            
                            <th>País</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($proveedores as $p){
                        ?>
                        <tr class="<?php echo $p['pais'] != 'España' ? 'table-warning' :  ''; ?>">
                            <td><?php echo $p['cif']; ?></td>
                            <td><?php echo $p['codigo']; ?></td>
                            <td><?php echo $p['nombre']; ?> <a href="<?php echo $p['website']; ?>" target="_blank"><i class="text-sm ml-1 fas fa-external-link-alt"></i></a></td>
                            <td><?php echo $p['direccion']; ?></td>                            
                            <td><?php echo $p['pais']; ?></td>                            
                            <td><a href="mailto:<?php echo $p['email']; ?>"><?php echo $p['email']; ?></a></td>
                            <td>
                            <?php 
                            if(!empty($p['telefono'])){
                                ?>
                                <a href="tel:<?php echo $p['telefono']; ?>"><?php echo $p['telefono']; ?></a>
                                <?php
                            }
                            else{
                                ?>
                                -
                                <?php
                            }
                            ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>                    
                </table>
                <?php
                }
                else{
                ?>
                <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
