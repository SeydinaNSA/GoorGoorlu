 <script langage="Javascript">
        
            var tabafaire = [];
            var tabfait = [];
            var tabpseudo1 = [];
             var tabpseudo2 = [];
         
         <?php 
         
if ( isset($_SESSION['id']))
{
    $ps=$_SESSION['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "goorgoorlu";
        try
        {        
         $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);   
         $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


                                    try
                                           {

                                           
                                           $reponse = $bdd->query("SELECT * FROM commandes  where prestataire= '$ps'");
                              
                                           while ($donnees = $reponse->fetch())
                                           {
                                                   if ($donnees['etat']=="afaire")
                                                   {
                                                       $temp=$donnees['numCom'];
                                                       $tem=$donnees['Client'];
                                                     ?> 

                                                     tabafaire.push("<?PHP echo $temp;?>");
                                                      tabpseudo1.push("<?PHP echo $tem;?>");
                                                       <?php  

                                                   }
                                        
                                                   if ($donnees['etat']=="fait")
                                                   {
                                                       $temp=$donnees['numCom'];
                                                       $tem=$donnees['Client'];
                                                     ?> 
                                                     tabfait.push("<?PHP echo $temp;?>");
                                                     tabpseudo2.push("<?PHP echo $tem;?>");
         
                                                       <?php
                                                   }
                                              // }

                                           } $reponse->closeCursor();
                                           }catch(Exception $e)
                                           {
                                           die('Erreur : '.$e->getMessage());
                                           }

        } 
        catch(PDOException $e)
            {
            echo "error" . $e->getMessage();
            }
        $conn = null;
   
  } 

?>
     
        function supelementtab (tab,element)
            {
               var d=0;
                
                while(tab[d]!=element)
                    {
                        d=d+1;
                    }
                var i;
                for (i=d;i<tab.length-1;i++)
                    {
                                          var temp=tab[i];
                                              tab[i]=tab[i+1];
                                              tab[i+1]=temp;
                    }
                tab.pop();
                
                
            }
        function addelementtab (tab,o)
            {
               
                tab.push(o);
                
            }
         function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
 var elment =ev.innerHTML;
         
       ev.drag=false;  
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
        
                supelementtab(tabafaire,data);
                addelementtab(tabfait,data);
   
}

        
       
        function debut(){
           afaire();
            fait();
        }
       
        function afaire(){
            
            document.getElementById('afaire').innerHTML='';
            var i;
            var text='';
            for (i=0;i<tabafaire.length;i++)
                {
                  text+='<div id="'+tabafaire[i]+'"  draggable="true" ondragstart="drag(event)" class="af" style="border:1px solid black;height:50px;width:250px;background-color:#2683a1; position:relative;left:auto;top:auto"  onmouseup="relache('+tabafaire[i]+')" onmousedown="presse('+tabafaire[i]+')" >  commande de '+tabpseudo1[i]+'</div>'; 
                }
            document.getElementById('afaire').innerHTML=text;
          
        }
       
        function fait(){
                        
            document.getElementById('fait').innerHTML='';
            var i;
            var text='';
            for (i=0;i<tabfait.length;i++)
                {
                  text+='<div id="'+tabfait[i]+'"  draggable="true" ondragstart="drag(event)"  class="ft" style="border:1px solid black;height:50px;width:250px;background-color:#2683a1; position:relative;left:auto;top:auto"  onmouseup="relache('+tabfait[i]+')" onmousedown="presse('+tabfait[i]+')"> commande de ' +tabpseudo2[i]+'  </div>'; 
                }
            document.getElementById('fait').innerHTML=text;
          
        }

     function save()
         {
             
             var save=true;
          
             
             if (save==true){
                  var x;var stat;var text1='';var text2='';var text4='';var text5='';var text3='';var text6='';var text7='';var a=0;var b=0;var c=0;
                 text1 = ' <div id="enreg" > <form action="Save.php" method="post"  >'; 
              <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "goorgoorlu";
try
{        
 $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);   
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
 try
                                   {
                                  
                                   $reponse = $bdd->query('SELECT * FROM commandes');
                                   while ($donnees = $reponse->fetch())
                                   {
                                       $state="";
                                       
                                       
                                        ?>
                                     
                                     
                                  for (x=0;x<tabafaire.length;x++)
                                         {
                                            
                                             if (tabafaire[x]=="<?PHP echo $donnees['numCom'];?>")
                                                 {
                                                     
       
       text2 += '<input name="afaire'+x+'" value="'+tabafaire[x]+'"  type="hidden"/>'; 
                                                     
                                         a=a+1;            
                                                 }
                                          
                                         }
                                     
                                      for (x=0;x<tabfait.length;x++)
                                         {
                                             if (tabfait[x]=="<?PHP echo $donnees['numCom'];?>")
                                                 {
         text4 += '<input name="fait'+x+'" value="'+tabfait[x]+'"  type="hidden"/>';
                                      c=c+1;                         
                                                     
                                                 }
                                         }
                  
                                      <?php
                                } $reponse->closeCursor();
     ?>
         text6 = '<input name="compta" value="'+a+'"  type="hidden"/>'+'<input name="comptb" value="'+b+'"  type="hidden"/>'+'<input name="comptc" value="'+c+'"type="hidden"/>'; 
            text7='Etes vous sur de vouloir enregistrer les modifications <br>'  ;
                 text5= '<input type="submit" value="Oui"/>  </form> </div>'; 
                 
                 
       
                                          document.getElementById('trois').innerHTML+=text1+text2+text3+text4+text6+text7+text5;
                 <?php
                                   }catch(Exception $e)
                                   {
                                   die('Erreur : '.$e->getMessage());
                                   }
    }
    
    
    
    catch (Exception $e)
                      {
                            die('Erreur : ' . $e->getMessage());
                      }
    
    
    
    ?>
                 
         }     
    header ('Location: Save.php');
    header ('Location: Save.php');
         }

 </script>