namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Dummy validation
        if ($username === 'admin' && $password === 'admin') {
            session()->set('logged_in', true);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
