package com.drazisil.lootmaster;

/**
 * Created by jwbec on 7/16/2017.
 */
import org.bukkit.Material;
import org.bukkit.SkullType;
import org.bukkit.entity.LivingEntity;
import org.bukkit.entity.Zombie;
import org.bukkit.entity.Player;
import org.bukkit.event.Listener;
import org.bukkit.event.EventHandler;
import org.bukkit.event.entity.EntityDeathEvent;
import org.bukkit.inventory.ItemStack;
import org.bukkit.material.Skull;

import java.util.Objects;
import java.util.Random;
import java.util.logging.Logger;

import static java.util.Random.*;

public final class DeathListener implements Listener {

    public final Logger logger = Logger.getLogger("MineCraft");

    @EventHandler
    public void DeathLogin(EntityDeathEvent event) {

        LivingEntity entity = event.getEntity();
        String world = entity.getLocation().getWorld().getName();
        Player killer = entity.getKiller();

        if (entity.getKiller() != null) {
            switch (entity.getName()) {
                case "Ender Dragon":
                    if (Objects.equals(world, "world_the_end")) {
                        ItemStack head = new ItemStack(Material.SKULL_ITEM);
                        head.setDurability((short) SkullType.DRAGON.ordinal());

                        ItemStack[] items = {head, new ItemStack(Material.ELYTRA)};
                        killer.getInventory().addItem(items);
                    }
                    break;
                case "Enderman":
                    Random rand = new Random();
                    int chance = rand.nextInt(100) + 1;
                    logger.info(String.valueOf(chance));
                    if( chance  <= 2 ) {
                        event.getDrops().add(new ItemStack(Material.SHULKER_SHELL, 1));
                    }
                    break;
                case "Shulker":
                    event.getDrops().clear();
                    event.getDrops().add(new ItemStack(Material.SHULKER_SHELL, 2));
                    break;
            }
        }
    }
}