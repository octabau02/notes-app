<?php

namespace App\Builders;

interface ExportBuilderInterface
{
    public function setId();
    public function setTitle();
    public function setContent();
    public function getType();
    public function setReminderDate();
    public function setSavedIn();
    public function setUser();
    public function setCreatedAt();
    public function setUpdatedAt();
    public function setWasUpdated();
    public function setIsImportant();
    public function build();
}
