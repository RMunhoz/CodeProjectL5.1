<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 20/09/16
 * Time: 13:21
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformers extends TransformerAbstract
{
    protected $defaultIncludes = ['members', 'files'];

    public function transform(Project $project)
    {
        return [
            'project_id' =>  $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'name' =>  $project->name,
            'description' =>  $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformers());
    }

    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformers());
    }

}