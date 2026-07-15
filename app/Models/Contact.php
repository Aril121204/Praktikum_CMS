<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    
    use HasFactory;

    
    protected $table = 'contacts';

    
    protected $fillable = [
        'name',       // Nama pengirim (dari form)
        'email',      // Email pengirim (dari form)
        'phone',      // Nomor telepon (dari form, opsional)
        'subject',    // Subjek pesan (dari form)
        'message',    // Isi pesan (dari form)
        'is_read',    // Status baca (default 'N' = belum dibaca)
    ];

    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    public function scopeUnread($query)
    {
        return $query->where('is_read', 'N');
    }

    
    public function scopeRead($query)
    {
        return $query->where('is_read', 'Y');
    }

   
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    
    public function markAsRead()
    {
        if ($this->is_read === 'N') {
            $this->update(['is_read' => 'Y']);
        }
    }

   
    public function markAsUnread()
    {
        if ($this->is_read === 'Y') {
            $this->update(['is_read' => 'N']);
        }
    }

    
    public function getIsReadStatusAttribute()
    {
        return $this->is_read === 'Y';
    }

   
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d M Y, H:i') . ' WIB';
    }

    
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

  
    public function getShortMessageAttribute()
    {
        return \Illuminate\Support\Str::limit($this->message, 100, '...');
    }
}