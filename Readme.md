# VIVOMEDIA.PartialRender

Inspired by [Psmb.Ajaxify](https://github.com/psmb/Psmb.Ajaxify)

## Install

```
composer require vivomedia/neos-partial-render
```

## Basic usage

```
prototype(Vendor.Site:SomeContentToLoadPartial) < prototype(Neos.Neos:ContentComponent) {

  renderPartialKey = VIVOMEDIA.PartialRender:RenderPartialKey
  @context.renderPartialKey = ${this.renderPartialKey}

  renderPartialUrl = Neos.Neos:NodeUri {
    node = ${documentNode}
    additionalParams.renderPartialKey = ${renderPartialKey}
  }

  renderer = afx`
    <div data-url-to-load={props.renderPartialUrl} />
  `
}
```
