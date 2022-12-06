<template>
    <div
      ref="map-root"
      style="width: 100%; height: 100%">
    </div>
  </template>
  
  <script>
    import View from 'ol/View';
    import Map from 'ol/Map';
    import TileLayer from 'ol/layer/Tile';
    import OSM from 'ol/source/OSM';
  
    // importing the OpenLayers stylesheet is required for having
    // good looking buttons!
    import 'ol/ol.css'
  
    export default {
      name: 'MapContainer',
      components: {},
      props: {
        geo: {
          type: Object
        }
      },
      mounted() {
        console.log(this.geo)
        // this is where we create the OpenLayers map
        new Map({
          // the map will be created using the 'map-root' ref
          target: this.$refs['map-root'],
          layers: [
            // adding a background tiled layer
            new TileLayer({
              source: new OSM() // tiles are served by OpenStreetMap
            }),
          ],
  
          // the map view will initially show the whole world
          view: new View({
            zoom: this.geo.zoom,
            center: [this.geo.location.lat, this.geo.location.lng],
            constrainResolution: true
          }),
        })
      },
    }
  </script>
  