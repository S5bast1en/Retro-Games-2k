<?php
function averageReview( $reviews ){
    $sum = 0; // met a 0 pour faire addition dessus
    foreach( $reviews as $review ){
        $sum += $review; // fait la somme de chaque note
    }
    return round( $sum / count( $reviews ), 1 ); // fait le calcul
}

function getGameType( $identifier ){
    return $GLOBALS['types'][ $identifier ];
}

function getShortDescription( $description, $size = 40 ){
    if( strlen( $description ) > $size ){
        return substr( $description, 0, $size ) . '...';
    }

    return $description;
}

function getShortReview( $review ){
    if( $review < 10 ){
        return 'star-o';
    }

    if( $review < 15 ){
        return 'star-half-o';
    }

    return 'star';
}

function needTriggerWarning( $type ){
    if( $type == "Horreur" || $type == "Adulte" ){
        return true;
    }

    return false;
}

function getFrenchDate( $date, $time = false ){
    $time = strtotime( $date );
    if( $time ){
        return date( 'd/m/Y - H:i', $time );
    }

    return date( 'd / m / Y', $time );
}


        /*Ma fonction permettant l'upload. D'abord je passe deux paramètres, file et config.
        uploadPicture( $_FILES['picture_file'] = $file, $uploadConfig = $config ); */


function uploadPicture( $file, $config ){
    if( $file['size'] > $config['max'] ){   //si le fichier est trop gros, je renvoi le tableau suivant
        return array(
            'status' => false,
            'message' => 'Le fichier est trop volumineux',
        );
    }


/*Ici je compare le type du fichier au tableau allows que j'ai défini, avec les types autorisés dedans*/
    if( !in_array( $file['type'], $config['allows'] ) ){    
        return array(
            'status' => false,
            'message' => 'Ce type de ficher n\'est pas autorisé',
        );
    }

    /*Si il n'y pas d'erreur, je rentre ici.*/
    /*avec $ext je récupére l'extension pour bien nommé le fichier*/
    /*Avec Name je défini un nom pour le fichier, ce sera media_ et l'extension récupérer*/
    /* avec $path je demande a ce que l'upload soit dans public/data/lenomquejeviensdegénérer*/

    $ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
    $name = uniqid( 'media_' ) . '.' . $ext; //uniq it crée un nom unique
    $path = $config['path'] . $name;

    // si ça s'est bien passé, je récupére avec le tableau suivant le chemin.
    move_uploaded_file( $file['tmp_name'], $path );
    return array(
        'status' => true,
        'path' => $path,
    );
}


        /* s'il y a une erreur je l'affichage dans un ul, même chose avec success*/

function showError( $errors ){
    if( !empty( $errors ) ){ ?>
        <div class="small-12 cell">
            <div class="callout alert">
                <ul><?php echo $errors; ?></ul>
            </div>
        </div>
     <?php }
}
function showSuccess( $success ){
    if( !empty( $success ) ){ ?>
        <div class="small-12 cell">
            <div class="callout success">
                <ul><?php echo $success; ?></ul>
            </div>
        </div>
     <?php }
}

function addLog( $message ){
    $file = fopen( "./logs/" . date("Y-m-d") . ".log", "a+" );
    fputs($file, date("Y-m-d H:i:s") . " - " . $message . "\n" );
    fclose( $file );
}