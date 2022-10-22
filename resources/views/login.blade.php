<html>

    <a href="{{ route('admin_google') }}">Admin Login</a>
    <br><br><br>
    <a href="{{ route('emp_google') }}">Employeer Login</a>
    {{-- <a href="{{ route('goog') }}">Employeer Login</a> --}}
    <br><br><br>
    {{-- <a href="{{ route('linkedin.login') }}"></a> --}}
 
    <a href="{{ route('applicant_google') }}">Applicant Login</a>

    <br><br><br><br><br>


    {{-- --------------------Login with Indeed------------- --}}

    {{-- <a href="{{ route('admin_indeed') }}">Admin Indeed Login</a> --}}
    {{-- --------------------Login with Indeed------------- --}}

 {{-- ----------------------Admin------------------ --}}
  <h4>Admin</h4>
    <form method="post" action="{{ route('admin_indeed') }}">
        @csrf
      <input type="submit" value="login with indeed">
    </form>
    <br><br><br><br><br>
 {{-- ----------------------Admin------------------ --}}

 {{-- ----------------------Employeer------------------ --}}
  <h4>Employeer</h4>
    <form method="post" action="{{ route('emp_indeed') }}">
        @csrf
      <input type="submit" value="login with indeed">
    </form>
    <br><br><br><br><br>
    <hr>
 {{-- ----------------------Employeer------------------ --}}

<h1>Employeer Login with Linkedin</h1>


    <form method="post" action="{{ route('emplinkedin_login') }}">
        @csrf
      <input type="submit" value="login with Linkedin">
    </form>
</html>