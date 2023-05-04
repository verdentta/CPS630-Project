
  <script>
    fetch('http://localhost/CPS630Project/Phase01/server/APIs/getEmployees.php')
      .then(res => res.json())
      .then(data => {
        data.forEach(employee => {
          const emp_info = `<div class="team-member">
                            <h2>${employee.employee_name}</h2>
                            <p>Role: ${employee.employee_role}</p>
                            <p>Email: ${employee.email}</p>
                            <p>${employee.employee_description}</p>
                            </div>`;

          document.querySelector("#emp_output").insertAdjacentHTML('beforeend', emp_info);
        });
      })
      .catch(error => {
        console.error(error);
      });
  </script>





    <h1>Meet the Team</h1>
    <div id="emp_output"></div>



