<?php
include_once '../class/Lancamento.php';
session_start();


     $l = new Lancamento;
     switch ($_POST['tipo_acao']) {
          case 'entrada':
               
               if (is_numeric($_POST['valor_l']) && is_numeric($_POST['qtn_l']) && is_numeric($_POST['descricao_p'])) {
                    
                    if (isset($_SESSION['nick']) && isset($_SESSION['nivel']) && isset($_SESSION['id_usuario'])) {
                         $l->adicionarLancamento($_POST['descricao_p'],$_SESSION['id_usuario'], $_POST['qtn_l'], ($_POST['valor_l']*$_POST['qtn_l']));
                         header('Location: ../index.php');
                         exit();
                    }else{
                         session_abort();
                         header('Location: ../login.php');
                         exit();
                    }

               }else{
                    
                    $_SESSION['Erronume'] = true;
                    header('Location: ../index.php');
                    exit();
               }

               break;
          case 'saida':
               
                              
               if (is_numeric($_POST['valor_l']) && is_numeric($_POST['descricao_p'])) {
                    
                    if (isset($_SESSION['nick']) && isset($_SESSION['nivel']) && isset($_SESSION['id_usuario'])) {
                         $l->adicionarLancamento($_POST['descricao_p'],$_SESSION['id_usuario'], 1, $_POST['valor_l']);
                         header('Location: ../index.php');
                         exit();
                    }else{
                         session_abort();
                         header('Location: ../login.php');
                         exit();
                    }

               }else{
                    
                    $_SESSION['Erronums'] = true;
                    header('Location: ../index.php');
                    exit();
               }

               break;
          
          default:
          $_SESSION['Erro'] = true;
          header('Location: ../index.php');
          exit();
               break;
     }


?>