<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function createUserDirectory(): void
    {
        $file_path = storage_path('codes/' . $this->id);

        mkdir($file_path, 0777, true);
        $programming_languages = ProgrammingLanguage::query()->get();

        $input = fopen($file_path . '/input.txt', 'w');
        $output = fopen($file_path . '/output.txt', 'w');

        fclose($input);
        fclose($output);

        foreach ($programming_languages as $programming_language) {
            mkdir($file_path . '/' . $programming_language->name, 0777, true);
            $file = fopen($file_path . '/' . $programming_language->name . '/code.' . $programming_language->extension, 'w');
            fclose($file);
        }
    }

    public function deleteUserDirectory(): void
    {
        $file_path = storage_path('codes/' . $this->id);
        File::deleteDirectory($file_path);
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === UserRole::USER;
    }

    public function isModerator(): bool
    {
        return $this->role === UserRole::MODERATOR;
    }

    public function socials(): HasMany
    {
        return $this->hasMany(UserSocial::class);
    }

    public function github(): HasOne
    {
        return $this->hasOne(UserSocial::class)->where('provider', 'github');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

}
