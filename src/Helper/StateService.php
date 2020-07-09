<?php

namespace Prhost\Colombo\Helper;

class StateService
{
    protected  $stateDirectory;

    /**
     * StateService constructor. Takes optional directory location otherwise current directory is used.
     * @param string $stateDirectory
     */
    public function __construct($stateDirectory = null)
    {
        assert(func_num_args() <= 1);
        $this->stateDirectory = $stateDirectory ? $stateDirectory : sys_get_temp_dir();
    }
    /**
     * Get the stored state variables from a file into an array.
     * State variables are stored as a file in json format.
     *
     * @param string $name - optional name of state file, if not provided 'default' is used.
     * @return array - Associative array of state variables
     * @throws \Exception
     */
    public function getState(string $name, $default = null)
    {
        $state = [];
        $fullPath = $this->stateDirectory . '/' . ltrim(rtrim($name)) . '.json';
        if (file_exists($fullPath))
        {
            $state = json_decode(file_get_contents($fullPath), true);
            if (!isset($state))
            {
                throw new \Exception(json_last_error_msg() . ' at: ' . $fullPath);
            }
        }
        return $state[ltrim(rtrim($name))] ?? $default;
    }
    /**
     * Saves the passed in array as a json file.
     * State variables are stored as a file in json format.
     * @param string $name - optional name of state file, if none provided 'default' is used.
     * @param $data - Associative array of state variables to be saved.
     * @return int - The number of bytes saved to the file.
     */
    public function saveState(string $name, $value) : int
    {
        $data[ltrim(rtrim($name))] = $value;

        assert(func_num_args() <= 2);
        $fullPath = $this->stateDirectory . '/' . ltrim(rtrim($name)) . '.json';
        return file_put_contents($fullPath, json_encode($data, JSON_PRETTY_PRINT));
    }
}