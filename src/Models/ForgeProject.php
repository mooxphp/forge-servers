<?php

namespace Moox\ForgeServer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ForgeProject extends Model
{
    protected $table = 'forge_projects';

    protected $fillable = [
        'name',
        'deployment_url',
        'server_id',
        'site_id',
        'last_deployment',
        'deployment_status',
        'deployed_by_user_id',
        'lock_deployments',
        'commits_behind',
        'last_commit_hash',
        'last_commit_url',
        'last_commit_message',
        'last_commit_author',
    ];

    protected $casts = [
        'last_deployment' => 'datetime',
        'lock_deployments' => 'boolean',
    ];

    public function server()
    {
        return $this->belongsTo(ForgeServer::class, 'server_id', 'forge_id');
    }

    public static function getForgeProjectAuthorOptions(): Collection
    {
        return static::select('last_commit_author')
            ->distinct()
            ->whereNotNull('last_commit_author')
            ->pluck('last_commit_author', 'last_commit_author');
    }
}
