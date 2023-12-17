<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<style>
  .footer{
      margin-top: 20%;
      background-color: #24262b;
        padding: 70px 0;
        color: #ffffff;
        height: 350px;
    }
    .footer-col{
       width: 25%;
       padding: 0 15px;
       margin-left:-10%;
    }
    .footer-col h4{
     
      font-size: 18px;
      color: #ffffff;
      text-transform: capitalize;
      margin-bottom: 35px;
      font-weight: 500;
      position: relative;
    }
    .footer-col h4::before{
      content: '';
      position: absolute;
      left:0;
      bottom: -10px;
      background-color: #0081C9;
      height: 2px;
      box-sizing: border-box;
      width: 50px;
    }
    .footer-col ul li:not(:last-child){
      margin-bottom: 10px;
    }
    .footer-col ul li a{
      font-size: 16px;
      text-transform: capitalize;
      color: #ffffff;
      text-decoration: none;
      font-weight: 300;
      color: #bbbbbb;
      display: block;
      transition: all 0.3s ease;
    }
    .footer-col ul li a:hover{
      color: #ffffff;
      padding-left: 8px;
    }
    .footer-col .social-links a{
      display: inline-block;
      height: 40px;
      width: 40px;
      background-color: rgba(255,255,255,0.2);
      margin:0 10px 10px 0;
      text-align: center;
      line-height: 40px;
      border-radius: 50%;
      color: #ffffff;
      transition: all 0.5s ease;
    }
    .footer-col .social-links a:hover{
      color: #24262b;
      background-color: #ffffff;
    }
    
    /*responsive*/
    @media(max-width: 767px){
      .footer-col{
        width: 50%;
        margin-bottom: 30px;
    }
    }
    @media(max-width: 574px){
      .footer-col{
        width: 100%;
    }
  }
  .cr-con{
    text-align: center;
    margin-top: 2%;
  }
  .footer-col p{
    margin-top: -3%;
  }
</style>

<footer class="footer">
    <div class="container">
     <div class="row">
       
       
       
       <div class="footer-col">
         <h4>Follow Us</h4>
         <div class="social-links">
           
           <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
           <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
           
           <h4>Email Us at:-</h4>
           <p>eComm@gmail.com</p>
         </div>
       </div>
     </div>
    </div>
    <div class='cr-con'>Copyright &copy; 2023</div>
 </footer>