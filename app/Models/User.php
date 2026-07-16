<?php
 
namespace App\Models;
 
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
 
    //untuk mengecek apakah user adalah admin
  public function isAdmin()
{
    // Cari data role yang namanya 'admin'
    $adminRole = \App\Models\Role::where('name', 'admin')->first();
    
    // Kembalikan nilai true jika role_id user sama dengan id milik admin
    return $adminRole && $this->role_id == $adminRole->id;
}
 
    // Helper method untuk cek role
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

   
}