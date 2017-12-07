<html>
<head>
  <script type="text/javascript">
  function validate(){
    var name=document.mform.name.value;
    if(name==null||name==""){
      alert("name is empty");
      return false;
    }
  }
  </script>
</head>
<body>
  <form name="mform" autocomplete="off">
    Name: <input name="name" type="text">
    Email: <input name="email" type="text" placeholder="Enter Your email">
    Password: <input name="pass" type="password" placeholder="Enter Your Password">
    <button onclick="validate()">Submit</button>
  </form>
</body>
</html>
