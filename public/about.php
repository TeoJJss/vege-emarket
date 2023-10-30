<?php
require '../modules/config.php'; // Validate user role
if ($role != '') {
   include '../includes/header.php'; // Get header
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>
</head>
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

   div.about-us *, div.form-container * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      outline: none;
      border: none;
      text-decoration: none;
   }


   .form-container form {
      padding: 110px;
      margin: 50px;
      margin-left: 15vw;
      margin-bottom: 0;
      border-radius: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
      background: white;
      text-align: center;
      width: 70%;
   }

   .form-container {
      min-height: 10vh;
      align-items: center;
      justify-content: center;
      padding: 20px;
      padding-bottom: 60px;
      background: #FFFDD0;
   }


   .form-container form h3 {
      font-size: 55px;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #333333;
   }

   .form-container form p {
      margin-top: 10px;
      font-size: 30px;
      color: #333333;
   }

   .about-us form {
      padding: 100px;
      margin-top: 10px;
      margin: 10px;
      border-radius: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
      background: white;
      text-align: center;
      width: 60%;
   }

   .about-us {
      min-height: 10vh;
      display: flex;
      top: 1px;
      align-items: center;
      justify-content: center;
      padding: 20px;
      padding-bottom: 60px;
      background: #FFFDD0;
   }

   .about-us form h3 {
      font-size: 40px;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #333333;
   }

   .about-us table {
      min-height: 10vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      padding-bottom: 40px;

   }
   img.back{
      position: fixed;
      left: 60px;
      top: 150px;
   }
   img.back:hover{
      width: 4.8%;
   }
</style>

<body>
   <div class="form-container">
      <a href="../index.php" title="Go back to homepage"><img class="back" src="../images/back.png" alt="Back" width="5%" style="clear:both;"></a>
      <form id="about us">

         <img src="../images/logo.png" width="400px" height="120px">
         <br></br>
         <section>
            <h3>About us</h3>
         </section>

         <section>

            <p style="text-align:justify;">Since we started in 2009, Vege E-Market has grown into a leading producer of high-quality vegetables,
               supplying both local supermarkets and international markets. Our commitment to sustainability, eco-friendly farming practices,
               and quality has driven our success. We look forward to continuing our mission of providing fresh,
               utritious produce to customers around the world. </p>
         </section>

      </form>
   </div>

   <div class="about-us">
      <form id="our team">
         <section>
            <h3> Our Team </h3>
         </section>

         <table>
            <tr>
               <td><img src="../images/unknown pic.jpg" width="200px" height="200px"></td>
               <td><img src="../images/unknown pic.jpg" width="200px" height="200px"></td>
               <td><img src="../images/unknown pic.jpg" width="200px" height="200px"></td>
               <td><img src="../images/unknown pic.jpg" width="200px" height="200px"></td>
            </tr>

            <tr>
               <th>Lim Heng Yang</th>
               <th>Teo Jun Jia</th>
               <th>Ng Jan Hwan</th>
               <th>Ko Zi Sheng</th>
            </tr>
         </table>

      </form>
   </div>
</body>

</html>




<?php include '../includes/footer.php'; ?>