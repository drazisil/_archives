package com.drazisil.lootmaster;

import org.bukkit.plugin.java.JavaPlugin;

public class LootMaster extends JavaPlugin {

    @Override
    public void onEnable(){
        getServer().getPluginManager().registerEvents(new DeathListener(), this);
        getLogger().info("onEnable has been invoked!");
    }

    @Override
    public void onDisable(){
        getLogger().info("onDisable has been invoked!");
    }
}

