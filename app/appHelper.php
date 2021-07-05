<?php

function getSetting($key, $default = '')
{
    if (is_array($key)) {
        $settings = \App\Models\Settings::whereIn('key', $key)->get();
        $data = [];
        foreach ($key as $item) {
            $found = false;
            foreach ($settings as $setting) {
                if ($setting->key == $item) {
                    $found = true;
                    $data[$setting->key] = $setting->value;
                }
                if (!$found) {
                    $data[$item] = $default;
                }
            }
        }
        return $data;
    } else {
        $setting = \App\Models\Settings::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return $default;
    }
}

function saveSetting($key, $value)
{
    $setting = \App\Models\Settings::where('key', $key)->first();
    if ($setting) {
        $setting->value = $value;
        $setting->save();
    } else {
        \App\Models\Settings::create([
            'key' => $key,
            'value' => $value
        ]);
    }
}
