#!/usr/bin/env bash
git subsplit init git@github.com:symplify/symplify.git

LAST_TAG=$(git tag -l | tail -n1);

# Symplify
git subsplit publish --heads="master" --tags=$LAST_TAG packages/AutoServiceRegistration:git@github.com:Symplify/AutoServiceRegistration.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/CodingStandard:git@github.com:Symplify/CodingStandard.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/ControllerAutowire:git@github.com:Symplify/ControllerAutowire.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/DefaultAutowire:git@github.com:Symplify/DefaultAutowire.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/DoctrineBehaviors:git@github.com:Symplify/DoctrineBehaviors.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/DoctrineExtensionsTree:git@github.com:Symplify/DoctrineExtensionsTree.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/DoctrineFixtures:git@github.com:Symplify/DoctrineFixtures.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/DoctrineMigrations:git@github.com:Symplify/DoctrineMigrations.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/EasyCodingStandard:git@github.com:Symplify/EasyCodingStandard.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/ModularDoctrineFilters:git@github.com:Symplify/ModularDoctrineFilters.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/ModularLatteFilters:git@github.com:Symplify/ModularLatteFilters.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/ModularRouting:git@github.com:Symplify/ModularRouting.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/PackageBuilder:git@github.com:Symplify/PackageBuilder.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/ServiceDefinitionDecorator:git@github.com:Symplify/ServiceDefinitionDecorator.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/Statie:git@github.com:Symplify/Statie.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/SymfonyEventDispatcher:git@github.com:Symplify/SymfonyEventDispatcher.git
git subsplit publish --heads="master" --tags=$LAST_TAG packages/SymfonySecurityVoters:git@github.com:Symplify/SymfonySecurityVoters.git

rm -rf .subsplit/

# inspired by laravel: https://github.com/laravel/framework/blob/master/build/illuminate-split-full.sh
